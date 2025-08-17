<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id int random_id bytes g_a
 * @return EncryptedChat
 */

final class RequestEncryption extends Instance {
	public function request(object $user_id,int $random_id,string $g_a) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf64daf43);
		$writer->write($user_id->read());
		$writer->writeInt($random_id);
		$writer->tgwriteBytes($g_a);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>