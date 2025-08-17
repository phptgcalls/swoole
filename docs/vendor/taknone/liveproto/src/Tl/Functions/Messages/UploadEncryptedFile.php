<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputencryptedchat peer inputencryptedfile file
 * @return EncryptedFile
 */

final class UploadEncryptedFile extends Instance {
	public function request(object $peer,object $file) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5057c497);
		$writer->write($peer->read());
		$writer->write($file->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>