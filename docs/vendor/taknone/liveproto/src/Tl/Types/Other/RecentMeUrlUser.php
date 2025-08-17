<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url long user_id
 * @return RecentMeUrl
 */

final class RecentMeUrlUser extends Instance {
	public function request(string $url,int $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb92c09e2);
		$writer->tgwriteBytes($url);
		$writer->writeLong($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['user_id'] = $reader->readLong();
		return new self($result);
	}
}

?>