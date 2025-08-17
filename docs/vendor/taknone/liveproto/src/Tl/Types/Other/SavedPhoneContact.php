<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone string first_name string last_name int date
 * @return SavedContact
 */

final class SavedPhoneContact extends Instance {
	public function request(string $phone,string $first_name,string $last_name,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1142bd56);
		$writer->tgwriteBytes($phone);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone'] = $reader->tgreadBytes();
		$result['first_name'] = $reader->tgreadBytes();
		$result['last_name'] = $reader->tgreadBytes();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>