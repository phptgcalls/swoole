<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param messagemedia media Vector<User> users
 * @return messages.WebPagePreview
 */

final class WebPagePreview extends Instance {
	public function request(object $media,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb53e8b21);
		$writer->write($media->read());
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['media'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>