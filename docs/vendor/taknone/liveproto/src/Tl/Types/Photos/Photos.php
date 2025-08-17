<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Photos;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Photo> photos Vector<User> users
 * @return photos.Photos
 */

final class Photos extends Instance {
	public function request(array $photos,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8dca6aa5);
		$writer->tgwriteVector($photos,'Photo');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['photos'] = $reader->tgreadVector('Photo');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>