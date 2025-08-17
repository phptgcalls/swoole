<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash string short_name string title string description photo photo document document
 * @return Game
 */

final class Game extends Instance {
	public function request(int $id,int $access_hash,string $short_name,string $title,string $description,object $photo,? object $document = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbdf9653b);
		$flags = 0;
		$flags |= is_null($document) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($short_name);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		$writer->write($photo->read());
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['short_name'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		$result['photo'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['document'] = $reader->tgreadObject();
		else:
			$result['document'] = null;
		endif;
		return new self($result);
	}
}

?>