<?php

namespace App\Http\Controllers\api;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyGallery;
use App\Http\Controllers\Controller;

class DiscoverController extends Controller
{
    public function property(Request $request)
    {
        try {
            $validated = $request->validate([
                'property_name' => 'required|string|max:255',
                'type' => 'required|string|max:100',
                'location' => 'required|string|max:255',
                'pricing' => 'required|numeric',
                'interest' => 'nullable|array',
                'interest.*' => 'string',
                'rules_and_regulations' => 'nullable|string',
                'description' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpg,jpeg,png',
                'status' => 'nullable',
                'property_type' => 'required',
                'beds' => 'required|numeric',
                'baths' => 'required|numeric',
                'area' => 'required|numeric'
            ]);

            if (isset($validated['interest'])) {
                $validated['interest'] = json_encode($validated['interest']);
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
            } else {
                return response()->json(['message' => 'No images found in request'], 400);
            }

            return response()->json([
                'message' => 'Property created successfully',
                'property' => $property->load('galleries')
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function index()
    {
        try {
            $properties = Property::orderBy('created_at')->get();

            $properties = $properties->map(function ($property) {
                $firstImage = $property->galleries->first();

                return [
                    'id' => $property->id,
                    'property_name' => $property->property_name,
                    'location' => $property->location,
                    'pricing' => $property->pricing,
                    'property_type' => $property->property_type,
                    'status' => $property->status,
                    'image' => $firstImage ? $firstImage->image : null
                ];
            });


            return response()->json([
                'message' => 'All properties fetched successfully',
                'data' => [
                    'properties' => $properties
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error fetching properties',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $property = Property::with('galleries')->find($id);

            if (!$property) {
                return response()->json([
                    'message' => 'Property not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Property fetched successfully',
                'property' => [
                    'property_name' => $property->property_name,
                    'type' => $property->type,
                    'location' => $property->location,
                    'beds' => $property->beds,
                    'baths' => $property->baths,
                    'area' => $property->area,
                    'description' => $property->description,
                    'pricing' => $property->pricing,
                    'interest' => $property->interest,
                    'status' => $property->status,
                    'property_type' => $property->property_type,
                    'galleries' => $property->galleries->map(function ($gallery) {
                        return asset($gallery->image);
                    })->toArray()
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to fetch property',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $property = Property::find($id);
            if (!$property) {
                return response()->json([
                    'message' => 'Property not found.'
                ], 404);
            }

            
            $validated = $request->validate([
                'property_name' => 'required|string|max:255',
                'type' => 'required|string|max:100',
                'location' => 'required|string|max:255',
                'pricing' => 'required|numeric',
                'interest' => 'nullable|array',
                'interest.*' => 'string',
                'rules_and_regulations' => 'nullable|string',
                'property_type' => 'nullable',
                'description' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpg,jpeg,png',
                'status' => 'nullable',
                'beds' => 'nullable',
                'baths' => 'nullable',
                'area' => 'nullable'
            ]);



            if (isset($validated['interest'])) {
                $validated['interest'] = json_encode($validated['interest']);
            }

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

            return response()->json([
                'message' => 'Property updated successfully',
                'property' => $property->load('galleries')
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $property = Property::with('galleries')->findOrFail($id);
            
            foreach ($property->galleries as $gallery) {
                $imagePath = public_path($gallery->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $gallery->delete();
            }

            $property->delete();

            return response()->json([
                'message' => 'Property deleted successfully.'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to delete property.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function DeleteImage($id)
    {
        try {
            $gallery = PropertyGallery::findOrFail($id);

            $imagePath = public_path($gallery->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $gallery->delete();

            return response()->json([
                'message' => 'Image deleted successfully.'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to delete image.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

}
