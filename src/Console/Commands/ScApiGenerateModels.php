<?php

namespace ThachVd\LaravelSiteControllerApi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ScApiGenerateModels extends Command
{
    protected $signature = 'sc-api:generate-models';
    protected $description = 'Generate Site Controller API models';

    public function handle()
    {
        $models = ['ScApiLog']; // models need create
        $modelPath = app_path('Models'); // models path (app/Models)

        if (!File::exists($modelPath)) {
            File::makeDirectory($modelPath, 0755, true);
        }

        foreach ($models as $model) {
            $modelFile = "$modelPath/$model.php";

            if (File::exists($modelFile)) {
                $this->warn("$model model already exists.");
                continue;
            }

            $content = "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class $model extends Model
{
    protected \$fillable = [
        'url',
        'method',
        'request',
        'response',
        'status_code',
        'created_at',
    ];
}
";

            File::put($modelFile, $content);
            $this->info("$model model created successfully.");
        }
    }
}
