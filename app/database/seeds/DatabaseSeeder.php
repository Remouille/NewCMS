<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PageTableSeeder');
		$this->call('LanguageTableSeeder');
		$this->call('TemplateTableSeeder');
		$this->call('UserTableSeeder');
	}

}

class PageTableSeeder extends Seeder {
	public function run()
	{
		DB::table('pages')->delete();
		Page::create(array(
			'title' => 'La home de mon site', 
			'url'=> '',
			'description'=> '',
			'website_id'=> '1',
			'template_id'=> '1'
		));
		Page::create(array(
			'title' => 'Le titre de ma page toto', 
			'url'=> 'titi',
			'description'=> '',
			'website_id'=> '1',
			'template_id'=> '2'
		));
		Page::create(array(
			'title' => 'Le titre de ma page TITI', 
			'url'=> 'titi',
			'description'=> '',
			'website_id'=> '1',
			'template_id'=> '1'
		));
		Page::create(array(
			'title' => 'Page Section/Truc', 
			'url'=> 'section/truc',
			'description'=> '',
			'website_id'=> '1',
			'template_id'=> '1'
		));
		$this->command->info('Page table seeded!');
	}
}

class TemplateTableSeeder extends Seeder {
	public function run()
	{
		DB::table('templates')->delete();
		Template::create(array(
			'title' => 'Home d\'Hotel', 
			'url'=> 'http://localhost/NewCMS/app/views/site/page.blade.php'
		));
		Template::create(array(
			'title' => 'Mon Template de Home', 
			'url'=> 'http://localhost/NewCMS/app/views/site/test.blade.php'
		));

		$this->command->info('Template table seeded!');
	}
}

class UserTableSeeder extends Seeder {
	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'username' => 'remi',
			'firstname' => 'Remi',
			'password' => Hash::make('toto'),
			'lastname' => 'Sala',
			'email'=> 'remi.sala@gmail.com',
			'type' => 'admin'
		));
		$this->command->info('User table seeded!');
	}
}

class LanguageTableSeeder extends Seeder {
	public function run()
	{
		DB::table('languages')->delete();
		Language::create(array(
			'code' => 'en', 
			'name'=> 'English'
		));
		Language::create(array(
			'code' => 'fr', 
			'name'=> 'Français'
		));
		Language::create(array(
			'code' => 'es', 
			'name'=> 'Spanish'
		));
		Language::create(array(
			'code' => 'de', 
			'name'=> 'Deutch'
		));
		$this->command->info('Language table seeded!');
	}
}