<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LlamaController extends Controller
{
    public function ask(Request $request)
    {
        try {
            // Validasi input 'prompt'
            $request->validate([
                'prompt' => 'required|string',
            ]);

            // Simpan prompt ke session
            session()->flash('prompt', $request->prompt);

            // Mengirim permintaan ke API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'user', 'content' => $request->prompt]
                ],
            ]);

            // Mengarahkan ke halaman /chatbot dan membawa data response
            return redirect('/chatbot')->with('response', $response->json()['choices'][0]['message']['content'] ?? 'No response');
        } catch (\Exception $e) {
            // Menangani kesalahan dan mengarahkan kembali dengan pesan error
            return redirect('/chatbot')->with('error', $e->getMessage());
        }
    }
}
