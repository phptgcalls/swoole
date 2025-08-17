<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputencryptedchat peer bytes g_b long key_fingerprint
 * @return EncryptedChat
 */

final class AcceptEncryption extends Instance {
	public function request(object $peer,string $g_b,int $key_fingerprint) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3dbc0415);
		$writer->write($peer->read());
		$writer->tgwriteBytes($g_b);
		$writer->writeLong($key_fingerprint);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>