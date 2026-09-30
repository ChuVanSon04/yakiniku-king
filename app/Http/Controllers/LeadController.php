<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'salutation' => ['required', Rule::in(['Ông', 'Bà'])],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $lead = Lead::create([
            ...$validated,
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Đăng ký nhận ưu đãi thành công.',
            'lead' => $lead,
        ], 201);
    }
}
