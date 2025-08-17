<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int collection_id string title Vector<InputSavedStarGift> delete_stargift Vector<InputSavedStarGift> add_stargift Vector<InputSavedStarGift> order
 * @return StarGiftCollection
 */

final class UpdateStarGiftCollection extends Instance {
	public function request(object $peer,int $collection_id,? string $title = null,? array $delete_stargift = null,? array $add_stargift = null,? array $order = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4fddbee7);
		$flags = 0;
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($delete_stargift) ? 0 : (1 << 1);
		$flags |= is_null($add_stargift) ? 0 : (1 << 2);
		$flags |= is_null($order) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($collection_id);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($delete_stargift) === false):
			$writer->tgwriteVector($delete_stargift,'InputSavedStarGift');
		endif;
		if(is_null($add_stargift) === false):
			$writer->tgwriteVector($add_stargift,'InputSavedStarGift');
		endif;
		if(is_null($order) === false):
			$writer->tgwriteVector($order,'InputSavedStarGift');
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