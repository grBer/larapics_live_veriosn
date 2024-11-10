 
<h1 align="center">
  Larapics
</h1>

<br/>

<p align="center"> 
  The following projct is a fully functional laravel project with CRUD  and authentication features letting users make their account, upload, delete, edit images. 
  The front-end is built with blade.<br/> <br/>
  There is three user categories.<br/><br/> 
  Admin: He/She can edit or deleting anyone's picture.<br/>
  Editor: He/She can edit anyone's picture but he/she can delete only his/her own pictures.<br/>
  Author: He/She can edit and delete only his/her own pictures. 
</p>

<h1 align="center">
  Installation
</h1>

<div align="center">
  Before you start set up I assume you have basic understanding with laravel set up.

  <br/>
  <br/>
 
  The files i provide in the repo is the way would be in a live server so you just need to follow the following steps and then run 
  the index.php within larapics_live_veriosn folder as an entry point.
 </div>
  
  
     
      1. Clone the repo or download it as zip and then unzip it to the folder you desire
      2. Open your command prompt and go to larapics folder
      3. Download the dependencies using composer install command
      4. Once installation of depedencies finish remain to larapics folder and run the command 'php artisan key:generate' to generate a new app key
      5. Edit .env file  by adding your credentials
      6. Run from your cmd within larapics folder the command 'php artisan migrate' to migrate with your database
      7. Run the symlink.php file (simply open your localhost in your browser and run it)
    
  <p align="center">
    *In step 7 after the execution of the symlink.php script a storage folder should be created to the same level with larapics folder.
     If not comment the version 1 within the symlink.php script and uncomment the version 2 and then run it again.
  </p>





