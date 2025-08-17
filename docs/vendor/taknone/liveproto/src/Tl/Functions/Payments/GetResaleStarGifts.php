<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long gift_id string offset int limit true sort_by_price true sort_by_num long attributes_hash Vector<StarGiftAttributeId> attributes
 * @return payments.ResaleStarGifts
 */

final class GetResaleStarGifts extends Instance {
	public function request(int $gift_id,string $offset,int $limit,? true $sort_by_price = null,? true $sort_by_num = null,? int $attributes_hash = null,? array $attributes = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7a5fa236);
		$flags = 0;
		$flags |= is_null($sort_by_price) ? 0 : (1 << 1);
		$flags |= is_null($sort_by_num) ? 0 : (1 << 2);
		$flags |= is_null($attributes_hash) ? 0 : (1 << 0);
		$flags |= is_null($attributes) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($attributes_hash) === false):
			$writer->writeLong($attributes_hash);
		endif;
		$writer->writeLong($gift_id);
		if(is_null($attributes) === false):
			$writer->tgwriteVector($attributes,'StarGiftAttributeId');
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