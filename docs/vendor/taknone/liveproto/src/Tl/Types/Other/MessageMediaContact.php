<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string first_name string last_name string vcard long user_id
 * @return MessageMedia
 */

final class MessageMediaContact extends Instance {
	public function request(string $phone_number,string $first_name,string $last_name,string $vcard,int $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x70322949);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		$writer->tgwriteBytes($vcard);
		$writer->writeLong($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_number'] = $reader->tgreadBytes();
		$result['first_name'] = $reader->tgreadBytes();
		$result['last_name'] = $reader->tgreadBytes();
		$result['vcard'] = $reader->tgreadBytes();
		$result['user_id'] = $reader->readLong();
		return new self($result);
	}
}

?>