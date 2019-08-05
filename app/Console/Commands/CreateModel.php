<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create models';


    /**
     * File source
     * @var string
     */
    protected $fileSource;

    /**
     * File result
     * @var string
     */
    protected $fileResult;

    /**
     * Name service
     * @var string
     */
    protected $name;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument("name");
        $this->fileSource = __DIR__."/source/model.txt";
        $this->fileResult = app_path()."/Model/$name.php";
        $this->name = $name;

        // Verifica se arquivo já existe
        if (file_exists($this->fileResult)) {
            $this->error("File {$this->fileResult} exists");
            return false;
        }

        // Conteudo
        $content = file_get_contents($this->fileSource);
        // Substituir conteudo
        $content = str_replace("DOCTOR",$this->name,$content);

        $fop = fopen($this->fileResult,"w+");
        fwrite($fop,$content);
        fclose($fop);

        $this->info("$name create");

    }
}
