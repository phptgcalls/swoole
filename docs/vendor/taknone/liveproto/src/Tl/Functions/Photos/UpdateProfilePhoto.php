<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Photos;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphoto id true fallback inputuser bot
 * @return photos.Photo
 */

final class UpdateProfilePhoto extends Instance {
	public function request(object $id,? true $fallback = null,? object $bot = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9e82039);
		$flags = 0;
		$flags |= is_null($fallback) ? 0 : (1 << 0);
		$flags |= is_null($bot) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($bot) === false):
			$writer->write($bot->read());
		endif;
		$writer->write($id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>