<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;

class PropertyController extends Controller
{
    public function add()
    {
        return view('pages.add_property');
    }

    public function add_property(Request $request)
    {

        dd($request->all());
        try {
            $validated = $request->validate([
                'property_name' => 'required|string|max:255',
                'type' => 'required|string|max:100',
                'location' => 'required|string|max:255',
                'pricing' => 'required|numeric',
                'interest' => 'nullable|array',
                'rules_and_regulations' => 'nullable|string',
                'description' => 'nullable|string',
                'images' => 'required|array',
                'images.*' => 'image|mimes:jpg,jpeg,png',
                'status' => 'nullable',
                'property_type' => 'required|in:sell,rent',
                'beds' => 'required|numeric',
                'baths' => 'required|numeric',
                'phone' => ['required', 'min:10', 'max:15'],
                'latitude' => 'nullable',
                'longitude' => 'nullable',
                'date_range' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        if (strpos($value, ' - ') === false) {
                            return $fail('The date range format is invalid.');
                        }

                        [$start, $end] = explode(' - ', $value);

                        try {
                            $startDate = Carbon::createFromFormat('Y-m-d', trim($start));
                            $today = Carbon::today();

                            if ($startDate->lt($today)) {
                                return $fail('The start date must be today or a future date.');
                            }
                        } catch (\Exception $e) {
                            return $fail('The date range is not in a valid format.');
                        }
                    }
                ],
                'airbnb' => 'required|numeric',
                'capitalvac' => 'required|numeric'
            ]);

            if (isset($validated['interest'])) {
                $interests = array_filter($validated['interest'], fn($value) => !empty(trim($value)));
                $validated['interest'] = json_encode(array_values($interests));
            }

            $property = Property::create($validated);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $galleryImage) {
                    $galleryName = Str::random(20) . '.' . $galleryImage->getClientOriginalExtension();
                    $galleryImage->move(public_path('/img/gallery'), $galleryName);

                    PropertyGallery::create([
                        'property_id' => $property->id,
                        'image' => 'img/gallery/' . $galleryName
                    ]);
                }
            }

            return redirect()->route('property')->with('success', 'Property created successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput(); // 👈 This line ensures old values are retained
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $th->getMessage())
                ->withInput(); // 👈 Optional: Also retain input on generic error
        }
    }

    public function index()
    {
        $properties = Property::with('galleries')
            ->whereNotIn('status', ['booking'])
            ->orderBy('created_at', 'desc') // latest entries first
            ->paginate(6);

        return view('pages.my_property', compact('properties'));
    }

    public function edit($id)
    {
        $property = Property::with('galleries')->findOrFail($id);


        if ($property->interest) {
            $property->interest = json_decode($property->interest, true);
        }

        return view('pages.edit_property', compact('property'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'property_name' => 'required|string|max:255',
                'type' => 'required|string|max:100',
                'location' => 'required|string|max:255',
                'pricing' => 'required|numeric',
                'interest' => 'nullable|array',
                'rules_and_regulations' => 'nullable|string',
                'description' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpg,jpeg,png',
                'status' => 'nullable',
                'property_type' => 'required|in:sell,rent',
                'beds' => 'required|numeric',
                'baths' => 'required|numeric',
                // 'area' => 'required|numeric',
                'airbnb' => 'required',
                'capitalvac' => 'required',
                'phone' => ['required', 'min:10', 'max:15'],
                'date_range' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        if (strpos($value, ' - ') === false) {
                            return $fail('The date range format is invalid.');
                        }

                        [$start, $end] = explode(' - ', $value);

                        try {
                            $startDate = Carbon::createFromFormat('Y-m-d', trim($start));
                            $today = Carbon::today();

                            if ($startDate->lt($today)) {
                                return $fail('The start date must be today or a future date.');
                            }
                        } catch (\Exception $e) {
                            return $fail('The date range is not in a valid format.');
                        }
                    }
                ],
            ]);


            if (isset($validated['interest'])) {
                $interests = array_filter($validated['interest'], function ($value) {
                    return !empty(trim($value));
                });
                $validated['interest'] = json_encode(array_values($interests));
            }

            $property = Property::findOrFail($id);
            $property->update($validated);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $galleryImage) {
                    $galleryName = Str::random(20) . '.' . $galleryImage->getClientOriginalExtension();
                    $galleryImage->move(public_path('/img/gallery'), $galleryName);

                    PropertyGallery::create([
                        'property_id' => $property->id,
                        'image' => 'img/gallery/' . $galleryName
                    ]);
                }
            }

            return redirect()->route('property')->with('success', 'Property updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function detail($id)
    {

        $property = Property::findOrFail($id);

        return view('pages.details_property', compact('property'));
    }

    public function reports()
    {

        $reports = Property::with('galleries')->get();
        return view('pages.manage_reports', compact('reports'));
    }

    public function discount()
    {
        $discounts = Property::with('galleries')->paginate(6);
        return view('pages.discounts_property', compact('discounts'));
    }

    public function applyDiscount(Property $property, Request $request)
    {
        $validated = $request->validate([
            'discount_percent' => 'required|numeric|min:0|max:100',
            'discount_price' => 'required|numeric|min:0'
        ]);

        $property->update([
            'disc_percent' => $validated['discount_percent'],
            'discounted' => $validated['discount_price']
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        $galleryImages = PropertyGallery::where('property_id', $property->id)->get();

        foreach ($galleryImages as $image) {
            if ($image->image) {
                $imagePath = public_path($image->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $image->delete();
        }


        if ($property->image) {
            $mainImagePath = public_path($property->image);

            if (file_exists($mainImagePath)) {
                unlink($mainImagePath);
            }
        }

        $property->delete();

        return redirect()->back()->with('success', 'Property and related images deleted successfully.');
    }

    public function list()
    {
        $properties = Property::with('galleries')
            ->where('status', 'booking')
            ->paginate(6);
        return view('pages.list_property', compact('properties'));
    }

    public function profile_edit(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'contact'       => 'nullable|string|max:50',
            'address'       => 'nullable|string|max:500',
            'bio'           => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'state'         => 'nullable|string|max:100',
            'country'       => 'nullable|string|max:100',
            'zip'           => 'nullable|string|max:20',
            'city'          => 'nullable|string|max:20'
        ]);

        $user->name    = $validated['name'];
        $user->email   = $validated['email'];
        $user->phone = $validated['contact'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->bio     = $validated['bio'] ?? null;
        $user->country = $validated['country'] ?? null;
        $user->state   = $validated['state'] ?? null;
        $user->zip     = $validated['zip'] ?? null;
        $user->city     = $validated['city'] ?? null;


        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Move to public/img folder
            $file->move(public_path('img'), $filename);

            // Save relative path in DB
            $user->image = 'img/' . $filename;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function calender()
    {
        return view('pages.calender');
    }

    public function fetchProperties(Request $request)
    {
        $date = $request->input('date'); // Format: YYYY-MM-DD

        $properties = DB::table('properties')
            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', 1), '%Y-%m-%d') <= ?", [$date])
            ->whereRaw("STR_TO_DATE(SUBSTRING_INDEX(date_range, ' - ', -1), '%Y-%m-%d') >= ?", [$date])
            ->select('property_name', 'pricing', 'airbnb', 'capitalvac')
            ->get();

        return response()->json($properties);
    }

    public function getAvailableDates(Request $request)
    {
        $month = $request->input('month'); // 1-12
        $year = $request->input('year');   // 4-digit year

        // Get all properties that have date_range overlapping with the month
        // Extract the start and end dates from date_range and find all dates

        // Simplify: Find all dates in the month that are available for any property

        // We'll get all date_ranges covering this month and collect the dates in that month

        $properties = DB::table('properties')
            ->select('date_range')
            ->get();

        $availableDates = [];

        foreach ($properties as $property) {
            [$startDate, $endDate] = explode(' - ', $property->date_range);

            $start = new DateTime($startDate);
            $end = new DateTime($endDate);

            // Clamp start and end within the requested month
            $monthStart = new DateTime("$year-$month-01");
            $monthEnd = new DateTime($monthStart->format('Y-m-t')); // last day of month

            if ($end < $monthStart || $start > $monthEnd) {
                continue; // no overlap with this month
            }

            if ($start < $monthStart) {
                $start = $monthStart;
            }
            if ($end > $monthEnd) {
                $end = $monthEnd;
            }

            $interval = new DateInterval('P1D');
            $period = new DatePeriod($start, $interval, $end->modify('+1 day')); // inclusive

            foreach ($period as $date) {
                $availableDates[] = $date->format('Y-m-d');
            }
        }

        // Remove duplicates and sort
        $availableDates = array_values(array_unique($availableDates));
        sort($availableDates);

        return response()->json($availableDates);
    }

    public function removeImage(Request $request)
    {

        $request->validate([
            'image' => 'required|string',
            'property_id' => 'required|integer',
        ]);

        $image = PropertyGallery::where('image', $request->image)
            ->where('property_id', $request->property_id)
            ->first();
        if ($image) {
            $imagePath = public_path('uploads/productImages/' . $image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Image ko folder se delete karo
            }
            // Image ko delete karo
            $image->delete();
            // Check karo ke agar yeh deleted image primary thi
            if ($image->is_primary == 1) {
                // Agle ya pehle available image ko primary bana do
                $nextImage = PropertyGallery::where('property_id', $request->property_id)
                    ->orderBy('id', 'asc')
                    ->first(); // Agla image dhoondho ya pehla image
                if ($nextImage) {
                    $nextImage->is_primary = 1; // Primary set karo
                    $nextImage->save();
                }
            }
            return response()->json(['success' => 'Image removed successfully']);
        }
        return response()->json(['error' => 'Image not found'], 404);
    }
}
