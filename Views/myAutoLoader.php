<?php
spl_autoload_register('autoload');

function autoload($className)
{
    $fileFound = false;
    //list comma separated directory name
    $directories = [
                    'Controllers/VolunteerController', 'Models/Jazz', 'Models/Cart', 'Models/Customer', 'Controllers/JazzController', "Enums", "Exceptions",
                    'Models', 'Views', 'Controllers', 'Config', 'Repositories/JazzRepo', 'Controllers/OrderController', 'Models/Volunteer',
                    'Repositories/OrderRepo', 'Models/Order', 'Models/Pdf', 'Repositories/CustomerRepo', 'Service', 'Service/NumberGenerator', 'Repositories/VolunteerRepo', 'Models/BundleTicket',
                    'Controllers/BundleTicketController', 'Repositories/BundleTicketRepo', 'Repositories', 'Controllers/DanceController', 'Repositories/DanceRepo', 'Models/Dance', 'Enums', 'StringObject',
                    'Models/PasswordReset', 'Repositories/PasswordResetRepo', 'Controllers/PasswordResetController', 'Repositories/CMSRepo', 'Controllers/CMSController'
                   ];
    //list of comma separated file format
    $fileExtensions = ['%s.php', '%s.class.php'];

    foreach ($directories as $dir)
    {
        foreach ($fileExtensions as $fileExtension)
        {
            $path = '../'.$dir.'/'.sprintf($fileExtension, $className);
            $alternativePath = $dir.'/'.sprintf($fileExtension, $className);
            $alternativePath2 = '../../'. $dir.'/'.sprintf($fileExtension, $className);

            if (file_exists($path)) {

                require_once $path;
                $fileFound = true;
                break;

            } elseif (file_exists($alternativePath)) {

                require_once $alternativePath;
                $fileFound = true;
                break;
            } elseif (file_exists($alternativePath2)) {

                require_once $alternativePath2;
                $fileFound = true;
                break;
            }
        }
        
        if ($fileFound) {
            break;
        }
    }
}
 ?>
