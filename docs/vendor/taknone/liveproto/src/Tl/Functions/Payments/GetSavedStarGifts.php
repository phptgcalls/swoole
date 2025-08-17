<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string offset int limit true exclude_unsaved true exclude_saved true exclude_unlimited true exclude_limited true exclude_unique true sort_by_value int collection_id
 * @return payments.SavedStarGifts
 */

final class GetSavedStarGifts extends Instance {
	public function request(object $peer,string $offset,int $limit,? true $exclude_unsaved = null,? true $exclude_saved = null,? true $exclude_unlimited = null,? true $exclude_limited = null,? true $exclude_unique = null,? true $sort_by_value = null,? int $collection_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa319e569);
		$flags = 0;
		$flags |= is_null($exclude_unsaved) ? 0 : (1 << 0);
		$flags |= is_null($exclude_saved) ? 0 : (1 << 1);
		$flags |= is_null($exclude_unlimited) ? 0 : (1 << 2);
		$flags |= is_null($exclude_limited) ? 0 : (1 << 3);
		$flags |= is_null($exclude_unique) ? 0 : (1 << 4);
		$flags |= is_null($sort_by_value) ? 0 : (1 << 5);
		$flags |= is_null($collection_id) ? 0 : (1 << 6);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($collection_id) === false):
			$writer->writeInt($collection_id);
		endif;
		$writer->tgwriteBytes($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>