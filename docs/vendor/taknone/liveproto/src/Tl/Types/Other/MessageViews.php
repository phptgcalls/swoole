<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int views int forwards messagereplies replies
 * @return MessageViews
 */

final class MessageViews extends Instance {
	public function request(? int $views = null,? int $forwards = null,? object $replies = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x455b853d);
		$flags = 0;
		$flags |= is_null($views) ? 0 : (1 << 0);
		$flags |= is_null($forwards) ? 0 : (1 << 1);
		$flags |= is_null($replies) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($views) === false):
			$writer->writeInt($views);
		endif;
		if(is_null($forwards) === false):
			$writer->writeInt($forwards);
		endif;
		if(is_null($replies) === false):
			$writer->write($replies->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['views'] = $reader->readInt();
		else:
			$result['views'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['forwards'] = $reader->readInt();
		else:
			$result['forwards'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['replies'] = $reader->tgreadObject();
		else:
			$result['replies'] = null;
		endif;
		return new self($result);
	}
}

?>