<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputencryptedchat peer long random_id bytes data inputencryptedfile file true silent
 * @return messages.SentEncryptedMessage
 */

final class SendEncryptedFile extends Instance {
	public function request(object $peer,int $random_id,string $data,object $file,? true $silent = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5559481d);
		$flags = 0;
		$flags |= is_null($silent) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeLong($random_id);
		$writer->tgwriteBytes($data);
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