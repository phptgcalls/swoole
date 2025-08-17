<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> messages int pts int pts_count
 * @return Update
 */

final class UpdateDeleteMessages extends Instance {
	public function request(array $messages,int $pts,int $pts_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa20db0e5);
		$writer->tgwriteVector($messages,'int');
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['messages'] = $reader->tgreadVector('int');
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		return new self($result);
	}
}

?>