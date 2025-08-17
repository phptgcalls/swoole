<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<int> messages int pts int pts_count int date
 * @return Update
 */

final class UpdateReadMessagesContents extends Instance {
	public function request(array $messages,int $pts,int $pts_count,? int $date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf8227181);
		$flags = 0;
		$flags |= is_null($date) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteVector($messages,'int');
		$writer->writeInt($pts);
		$writer->writeInt($pts_count);
		if(is_null($date) === false):
			$writer->writeInt($date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['messages'] = $reader->tgreadVector('int');
		$result['pts'] = $reader->readInt();
		$result['pts_count'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['date'] = $reader->readInt();
		else:
			$result['date'] = null;
		endif;
		return new self($result);
	}
}

?>