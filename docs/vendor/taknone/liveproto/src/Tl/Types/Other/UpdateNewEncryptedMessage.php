<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param encryptedmessage message int qts
 * @return Update
 */

final class UpdateNewEncryptedMessage extends Instance {
	public function request(object $message,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x12bcbd9a);
		$writer->write($message->read());
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['message'] = $reader->tgreadObject();
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>