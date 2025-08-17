<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string title Vector<int> stories
 * @return StoryAlbum
 */

final class CreateAlbum extends Instance {
	public function request(object $peer,string $title,array $stories) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa36396e5);
		$writer->write($peer->read());
		$writer->tgwriteBytes($title);
		$writer->tgwriteVector($stories,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>