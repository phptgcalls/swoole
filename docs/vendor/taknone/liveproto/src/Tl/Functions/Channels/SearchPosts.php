<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset_rate inputpeer offset_peer int offset_id int limit string hashtag string query long allow_paid_stars
 * @return messages.Messages
 */

final class SearchPosts extends Instance {
	public function request(int $offset_rate,object $offset_peer,int $offset_id,int $limit,? string $hashtag = null,? string $query = null,? int $allow_paid_stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf2c4f24d);
		$flags = 0;
		$flags |= is_null($hashtag) ? 0 : (1 << 0);
		$flags |= is_null($query) ? 0 : (1 << 1);
		$flags |= is_null($allow_paid_stars) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($hashtag) === false):
			$writer->tgwriteBytes($hashtag);
		endif;
		if(is_null($query) === false):
			$writer->tgwriteBytes($query);
		endif;
		$writer->writeInt($offset_rate);
		$writer->write($offset_peer->read());
		$writer->writeInt($offset_id);
		$writer->writeInt($limit);
		if(is_null($allow_paid_stars) === false):
			$writer->writeLong($allow_paid_stars);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>