class main
	theme_header('title');
	Query('SELECT * FROM `people` WHERE id=:id AND `active` = 0', ['id' => 1556567]);
	Insert('SELECT * FROM `people` WHERE id=:id AND `active` = 0', ['id' => 1556567]);
class file
	uploadimages('dir', 'max_size');
