<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string first_name string last_name int user_id
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaContact extends Instance {
	public function request(string $phone_number,string $first_name,string $last_name,int $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x588a0a97);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		$writer->writeInt($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_number'] = $reader->tgreadBytes();
		$result['first_name'] = $reader->tgreadBytes();
		$result['last_name'] = $reader->tgreadBytes();
		$result['user_id'] = $reader->readInt();
		return new self($result);
	}
}

?>