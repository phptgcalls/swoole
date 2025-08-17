<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long client_id string phone string first_name string last_name
 * @return InputContact
 */

final class InputPhoneContact extends Instance {
	public function request(int $client_id,string $phone,string $first_name,string $last_name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf392b7f4);
		$writer->writeLong($client_id);
		$writer->tgwriteBytes($phone);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['client_id'] = $reader->readLong();
		$result['phone'] = $reader->tgreadBytes();
		$result['first_name'] = $reader->tgreadBytes();
		$result['last_name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>