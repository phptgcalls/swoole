<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string first_name string last_name string vcard
 * @return InputMedia
 */

final class InputMediaContact extends Instance {
	public function request(string $phone_number,string $first_name,string $last_name,string $vcard) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf8ab7dfb);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		$writer->tgwriteBytes($vcard);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_number'] = $reader->tgreadBytes();
		$result['first_name'] = $reader->tgreadBytes();
		$result['last_name'] = $reader->tgreadBytes();
		$result['vcard'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>