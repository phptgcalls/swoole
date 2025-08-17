<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Photos;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<Photo> photos Vector<User> users
 * @return photos.Photos
 */

final class PhotosSlice extends Instance {
	public function request(int $count,array $photos,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x15051f54);
		$writer->writeInt($count);
		$writer->tgwriteVector($photos,'Photo');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['photos'] = $reader->tgreadVector('Photo');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>