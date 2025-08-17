<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser id string first_name string last_name string phone true add_phone_privacy_exception
 * @return Updates
 */

final class AddContact extends Instance {
	public function request(object $id,string $first_name,string $last_name,string $phone,? true $add_phone_privacy_exception = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe8f463d0);
		$flags = 0;
		$flags |= is_null($add_phone_privacy_exception) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($id->read());
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		$writer->tgwriteBytes($phone);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>