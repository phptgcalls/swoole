<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date encryptedfile file
 * @return messages.SentEncryptedMessage
 */

final class SentEncryptedFile extends Instance {
	public function request(int $date,object $file) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9493ff32);
		$writer->writeInt($date);
		$writer->write($file->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['date'] = $reader->readInt();
		$result['file'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>