<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class AssistantService
{
    public function getResponseFromAssistant($userMessage)
    {
        $assistantId = 'asst_F4ka8zAXAMDfcmqomE57L7L8';

        $thread = OpenAI::threads()->create([]);
        $message = OpenAI::threads()->messages()->create($thread->id, [
            'role' => 'user',
            'content' => $userMessage,
        ]);

        $run = OpenAI::threads()->runs()->create(
            threadId: $thread->id,
            parameters: [
                'assistant_id' => $assistantId,
            ]
        );

        while (in_array($run->status, ['queued', 'in_progress'])) {
            $run = OpenAI::threads()->runs()->retrieve(
                threadId: $thread->id,
                runId: $run->id,
            );
            sleep(1);
        }

        if ($run->status === 'completed') {
            $messages = OpenAI::threads()->messages()->list($thread->id, [
                'order' => 'asc',
                'after' => $message->id,
                'limit' => 10,
            ]);

            $responseText = '';
            foreach ($messages->data as $message) {
                $responseText .= $message->content[0]->text->value . "\n\n";
            }

            return rtrim($responseText);
        }

        return null;
    }
}
