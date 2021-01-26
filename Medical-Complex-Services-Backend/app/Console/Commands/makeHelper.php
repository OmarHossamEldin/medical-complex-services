<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class makeHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {className : set the name of helper class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a New Custom Helper Class';

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
     * Create Helpers Directory if not exist and 
     * create helper class with passed name argument in Helpers directory.
     * write init code for the class
     * @param string $name of the class
     * @return 
     */
    public function handle()
    {
       if (is_dir('app/Helpers')){
          if(is_dir("app/Helpers/{$this->argument('className')}.php")==false){

            $helperClass = fopen("app/Helpers/{$this->argument('className')}.php", "w");
            $code = "<?php \n\nnamespace App\Helpers; \n\nclass {$this->argument('className')}{\n\n}";
            fwrite($helperClass, $code);
            exec('composer dump-autoload');     //command to register helper class
            echo 'Helper Class Has Been Created';
          }
          else{
            echo 'Helper Class is exist';
          }
       }
       else{
           
           mkdir('app/Helpers');
           $this->handle();
       }
    }
}
