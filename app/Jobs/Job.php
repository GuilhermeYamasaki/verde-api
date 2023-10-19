<?php

namespace App\Jobs;

use App\Enums\DispatchedJobStatus;
use App\Models\DispachedJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $id;
    private readonly DispachedJob $model;

    public function processStatus()
    {
        DispachedJob::find($this->id)->update([
            'status' => DispatchedJobStatus::PROCESSING,
        ]);
    }

    public function endedStatus(DispatchedJobStatus $status, string $response)
    {
        DispachedJob::find($this->id)->update([
            'status' => $status,
            'response' => $response
        ]);
    }

    public static function send(array $parameters): string
    {
        $jobName = collect(
            explode('\\', static::class)
        )->last();

        $jobId = DispachedJob::create([
            'job' => $jobName,
            'status' => DispatchedJobStatus::CREATED,
        ])->id;

        $job = app(static::class, $parameters);
        $job->id = $jobId;
        dispatch($job);

        return $jobId;
    }
}
