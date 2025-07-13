<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{

    // GET DATA
    public function index(Request $request)
    {
        // Cek apakah user terautentikasi
        if (!$request->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        // Query dengan relasi "division"
        $employees = Employees::with('division')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('division_id'), function ($query) use ($request) {
                $query->where('division_id', $request->division_id);
            })
            ->paginate(10);

        // Return dengan resource dan pagination
        return response()->json([
            'status' => 'success',
            'message' => 'Daftar pegawai berhasil diambil',
            'data' => [
                'employees' => EmployeeResource::collection($employees->items()),
            ],
            'pagination' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
                'from' => $employees->firstItem(),
                'to' => $employees->lastItem(),
            ],
        ]);
    }
    // GET DATA SELESAI


    // CREATE DATA
    public function store(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'image' => 'nullable|url',
            'divisi_id' => 'required|exists:divisis,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data employee
        $employee = Employees::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'position' => $request->position,
            'phone' => $request->phone,
            'image' => $request->image ?? 'https://via.placeholder.com/150x150.png?text=photo',
            'divisi_id' => $request->divisi_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pegawai berhasil ditambahkan',
            'data' => [
                'employee' => [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'phone' => $employee->phone,
                    'phone' => $employee->phone,
                    'image' => $employee->image,
                    'position' => $employee->position,
                    'division' => [
                        'id' => $employee->division->id,
                        'name' => $employee->division->name,
                    ]
                ]
            ]
        ], 201);
    }
    // CREATE DATA SELESAI


    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|url',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisis,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $employee = Employees::find($id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pegawai tidak ditemukan',
            ], 404);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('images', 'public');
            $imageUrl = asset('storage/' . $imagePath);
            $employee->image = $imageUrl;
        }

        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->position = $request->position;
        $employee->divisi_id = $request->divisi_id;
        $employee->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data pegawai berhasil diperbarui',
        ]);
    }
    // UPDATE DATA SELESAI


    // DELETE DATA
    public function delete($id)
    {
        $employee = Employees::find($id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pegawai tidak ditemukan',
            ], 404);
        }

        // Optional: hapus file gambar dari storage kalau perlu
        // Storage::delete('public/path-to-image...');

        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data pegawai berhasil dihapus',
        ]);
    }
}
