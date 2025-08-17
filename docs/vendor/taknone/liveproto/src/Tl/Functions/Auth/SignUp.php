<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash string first_name string last_name true no_joined_notifications
 * @return auth.Authorization
 */

final class SignUp extends Instance {
	public function request(string $phone_number,string $phone_code_hash,string $first_name,string $last_name,? true $no_joined_notifications = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xaac7b717);
		$flags = 0;
		$flags |= is_null($no_joined_notifications) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>