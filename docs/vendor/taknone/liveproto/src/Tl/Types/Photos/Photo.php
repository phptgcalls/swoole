<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Photos;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param photo photo Vector<User> users
 * @return photos.Photo
 */

final class Photo extends Instance {
	public function request(object $photo,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x20212ca8);
		$writer->write($photo->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['photo'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>