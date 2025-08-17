<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id true need_rating true need_debug true video phonecalldiscardreason reason int duration
 * @return PhoneCall
 */

final class PhoneCallDiscarded extends Instance {
	public function request(int $id,? true $need_rating = null,? true $need_debug = null,? true $video = null,? object $reason = null,? int $duration = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x50ca4de1);
		$flags = 0;
		$flags |= is_null($need_rating) ? 0 : (1 << 2);
		$flags |= is_null($need_debug) ? 0 : (1 << 3);
		$flags |= is_null($video) ? 0 : (1 << 6);
		$flags |= is_null($reason) ? 0 : (1 << 0);
		$flags |= is_null($duration) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		if(is_null($reason) === false):
			$writer->write($reason->read());
		endif;
		if(is_null($duration) === false):
			$writer->writeInt($duration);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['need_rating'] = true;
		else:
			$result['need_rating'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['need_debug'] = true;
		else:
			$result['need_debug'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['video'] = true;
		else:
			$result['video'] = false;
		endif;
		$result['id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['reason'] = $reader->tgreadObject();
		else:
			$result['reason'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['duration'] = $reader->readInt();
		else:
			$result['duration'] = null;
		endif;
		return new self($result);
	}
}

?>