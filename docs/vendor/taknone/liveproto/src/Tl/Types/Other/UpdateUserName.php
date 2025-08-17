<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id string first_name string last_name Vector<Username> usernames
 * @return Update
 */

final class UpdateUserName extends Instance {
	public function request(int $user_id,string $first_name,string $last_name,array $usernames) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa7848924);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($first_name);
		$writer->tgwriteBytes($last_name);
		$writer->tgwriteVector($usernames,'Username');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['first_name'] = $reader->tgreadBytes();
		$result['last_name'] = $reader->tgreadBytes();
		$result['usernames'] = $reader->tgreadVector('Username');
		return new self($result);
	}
}

?>