<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
    public function extractDataFromImage(string $imageBase64): array
    {
        try {

            $response = OpenAI::responses()->create([
                'model' => 'gpt-5.2',

                'prompt' => [
                    'id' => config('openai.prompt_id')
                ],

                'input' => [
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'input_text',
                                'text' => 'json'
                            ],
                            [
                                'type' => 'input_image',
                                'image_url' => "data:image/jpeg;base64,{$imageBase64}"
                            ]
                        ]
                    ]
                ]
            ]);

            foreach ($response->output as $item) {
                if (!isset($item->content)) {
                    continue;
                }
                foreach ($item->content as $content) {

                    if ($content->type === 'output_json') {
                        return (array) $content->json;
                    }

                    if ($content->type === 'output_text') {
                        $decoded = json_decode($content->text, true);
                        if (is_array($decoded)) {
                            return $decoded;
                        }
                    }
                }
            }

            throw new \Exception('OpenAI returned no usable JSON output');

        } catch (\Throwable $e) {
            throw new \Exception('OpenAI error: ' . $e->getMessage());
        }
    }
}
