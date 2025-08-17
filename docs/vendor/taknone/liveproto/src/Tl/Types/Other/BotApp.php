<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash string short_name string title string description photo photo long hash document document
 * @return BotApp
 */

final class BotApp extends Instance {
	public function request(int $id,int $access_hash,string $short_name,string $title,string $description,object $photo,int $hash,? object $document = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x95fcd1d6);
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
		$writer->writeLong($hash);
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
		$result['hash'] = $reader->readLong();
		return new self($result);
	}
}

?>