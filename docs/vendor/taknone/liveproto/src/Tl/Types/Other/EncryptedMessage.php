<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long random_id int chat_id int date bytes bytes encryptedfile file
 * @return EncryptedMessage
 */

final class EncryptedMessage extends Instance {
	public function request(int $random_id,int $chat_id,int $date,string $bytes,object $file) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xed18c118);
		$writer->writeLong($random_id);
		$writer->writeInt($chat_id);
		$writer->writeInt($date);
		$writer->tgwriteBytes($bytes);
		$writer->write($file->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['random_id'] = $reader->readLong();
		$result['chat_id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['bytes'] = $reader->tgreadBytes();
		$result['file'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>