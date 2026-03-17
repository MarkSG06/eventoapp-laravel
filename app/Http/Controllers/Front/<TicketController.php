<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function extract_data(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|string',
            ]);

            $imageBase64 = $request->input('image');

            if (str_contains($imageBase64, 'data:image')) {
                $imageBase64 = explode(',', $imageBase64)[1];
            }

            $imageContent = base64_decode($imageBase64);
            $filename = date('Y-m-d_H-i-s') . '.jpg';
            \Illuminate\Support\Facades\Storage::disk('local')->put('tickets/' . $filename, $imageContent);

            $result = $this->openAIService->extractDataFromImage($imageBase64);
            
            return response()->json([
                'success' => true,
                'data' => $result,
            ]);

        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json([
                'success' => false,
                'message' => $ve->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error al procesar imagen en TicketController: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al procesar la imagen. Revisa los logs.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
