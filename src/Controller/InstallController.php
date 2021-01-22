<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @author    Kohei Koja
 */

 namespace App\Controller;

 use App\Controller\AppController;
 use Cake\Database\Connection;
 use Cake\Datasource\ConnectionManager;
 use Cake\ORM\Locator\LocatorAwareTrait;

 class InstallController extends AppController
 {

    /**
     * First installation.
     * Takes SQL statements from the file and execute them to create
     * tables and root user.
     */
    public function index() 
    {
        $errors = array();
        
        try
        {

            $conncection = ConnectionManager::get('default');

            // The path to SQL file should be "<ROOT>/config/schema/<SQL_file>".
            $pathToSQL = ROOT . DS . 'config' . DS . 'schema' . DS . 'koja_website.sql';
            $statements = file_get_contents($pathToSQL);
            $statements = explode(';', $statements);


            foreach ($statements as $statement)
            {
                if (trim($statement) !== '')
                {
                    try
                    {
                        $conncection->query($statement);
                    }
                    catch (Exception $e)
                    {
                        // if something is wrong, add the error to the array.
                        $errors[] = $e->getMessage();
                        continue;
                    }
                }
            }
        }
        catch (Exception $e)
        {
            $errors[] = 'File: ' . $e->getFile() . '\n';
            $errors[] = 'Code: ' . $e->getCode() . '\n';
            $errors[] = 'Message: ' . $e->getMessage() . '\n';
        }
        finally
        {
            // see if there is any error or not
            if (count($errors) == 0)
            {
                $this->Flash->success('The installation was successful! Added tables into the database.');
                $this->autoRender = false;
                return $this->redirect([
                    'controller' => 'Home',
                    'action' => 'index'
                ]);
            }
            else
            {
                // switch to error layout
                $this->viewBuilder()->setLayout('error');
                $this->set(compact('errors'));
                $this->render('error');
                return;
            }

        }
    }
 }
 ?>