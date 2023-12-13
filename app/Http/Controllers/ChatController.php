<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\OpenAI;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    // public function chat(Request $request)
    // {

    //     $userMessage = $request->input('message');

    //     $openai = new OpenAI('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');
    //     $response = $openai->completions->create([
    //         'model' => 'gpt-3.5-turbo',
    //         'messages' => [
    //             ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //             ['role' => 'user', 'content' => $userMessage],
    //         ],
    //     ]);

    //     $botMessage = $response->data['choices'][0]['message']['content'];

    //     return response()->json(['message' => $botMessage]);
    // }

    //   public function openai(): JsonResponse
    // {
    //     $search = "laravel get ip address";
  
    //     $data = Http::withHeaders([
    //                 'Content-Type' => 'application/json',
    //                 'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
    //               ])
    //               ->post("https://api.openai.com/v1/chat/completions", [
    //                 "model" => "gpt-3.5-turbo",
    //                 'messages' => [
    //                     [
    //                        "role" => "user",
    //                        "content" => $search
    //                    ]
    //                 ],
    //                 'temperature' => 0.5,
    //                 "max_tokens" => 200,
    //                 "top_p" => 1.0,
    //                 "frequency_penalty" => 0.52,
    //                 "presence_penalty" => 0.5,
    //                 "stop" => ["11."],
    //               ])
    //               ->json();
    //               \Illuminate\Support\Facades\Log::info('OpenAI API Request1: ', ['request' => $search, 'response' => $data]);

    //   //dd(env('OPENAI_API_KEY'),$data);
    //     return response()->json($data['choices'][0]['message'], 200, array(), JSON_PRETTY_PRINT);
    // }
    public function openai(): JsonResponse
{
    $search = "laravel get ip address";

    // Implement rate limiting
    $cacheKey = 'openai_request_' . md5($search);
    $limitInSeconds = 60; // Adjust this based on your requirements
 if (\Illuminate\Support\Facades\Cache::has($cacheKey)) {
        return response()->json(['error' => 'Rate limit exceeded.'], 429);
    }
    try {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            'messages' => [
                [
                    "role" => "user",
                    "content" => $search,
                ],
            ],
            'temperature' => 0.5,
            "max_tokens" => 200,
            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            "stop" => ["11."],
        ]);

        $response->throw();

        $data = $response->json();
   \Illuminate\Support\Facades\Cache::put($cacheKey, true, now()->addSeconds($limitInSeconds));
  
        // Check if 'choices' key exists before accessing it
        if (isset($data['choices'][0]['message'])) {
            return response()->json($data['choices'][0]['message'], 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json(['error' => 'Invalid response structure.'], 500);
        }
    } catch (\Illuminate\Http\Client\RequestException $e) {
        $response = $e->response;

        // Log the error for debugging purposes      
        Log::error('OpenAI API Error: ' . $response->body());
        Log::error('OpenAI API Error - Status Code: ' . $response->status());
        Log::error('OpenAI API Error - Response Body: ' . $response->body());

        return response()->json(['error' => 'An unexpected error occurred.'], 500);
    }
}
// public function openai(): JsonResponse
// {
//    $search = "laravel get ip address";
//     $maxRetries = 300;
//     $retryDelay = 500; // Initial delay in seconds

//      for ($retryCount = 0; $retryCount < $maxRetries; $retryCount++) {
//         try {
//         $response = Http::withHeaders([
//             'Content-Type' => 'application/json',
//             'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
//         ])->post("https://api.openai.com/v1/chat/completions", [
//             "model" => "gpt-3.5-turbo",
//             'messages' => [
//                 [
//                     "role" => "user",
//                     "content" => $search,
//                 ],
//             ],
//             'temperature' => 0.5,
//             "max_tokens" => 200,
//             "top_p" => 1.0,
//             "frequency_penalty" => 0.52,
//             "presence_penalty" => 0.5,
//             "stop" => ["11."],
//         ]);

//         $statusCode = $response->status();

//         // Check if the request was successful
//         if ($statusCode == 200) {
//             $data = $response->json();

//             // Check if 'choices' key exists before accessing it
//             if (isset($data['choices'][0]['message'])) {
//                 return response()->json($data['choices'][0]['message'], 200, [], JSON_PRETTY_PRINT);
//             } else {
//                 return response()->json(['error' => 'Invalid response structure.'], 500);
//             }
//         } elseif ($statusCode == 429) {
//             // Retry-After header indicates the number of seconds to wait before retrying
//             sleep($retryDelay);
//                 $retryDelay *= 2; 
//          //  return response()->json(['error' => 'Rate limit exceeded. Retrying..'], 429);
//         } else {
//             return response()->json(['error' => 'Unexpected error.'], 500);
//         }
//     } catch (\Illuminate\Http\Client\RequestException $e) {
//         return response()->json(['error' => 'An unexpected error occurred.'], 500);
//     }
// }
//  return response()->json(['error' => 'Max retries reached.'], 500);
// }

}