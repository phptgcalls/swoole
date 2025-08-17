<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<StarGift> gifts Vector<Chat> chats Vector<User> users string next_offset Vector<StarGiftAttribute> attributes long attributes_hash Vector<StarGiftAttributeCounter> counters
 * @return payments.ResaleStarGifts
 */

final class ResaleStarGifts extends Instance {
	public function request(int $count,array $gifts,array $chats,array $users,? string $next_offset = null,? array $attributes = null,? int $attributes_hash = null,? array $counters = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x947a12df);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$flags |= is_null($attributes) ? 0 : (1 << 1);
		$flags |= is_null($attributes_hash) ? 0 : (1 << 1);
		$flags |= is_null($counters) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->tgwriteVector($gifts,'StarGift');
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		if(is_null($attributes) === false):
			$writer->tgwriteVector($attributes,'StarGiftAttribute');
		endif;
		if(is_null($attributes_hash) === false):
			$writer->writeLong($attributes_hash);
		endif;
		$writer->tgwriteVector($chats,'Chat');
		if(is_null($counters) === false):
			$writer->tgwriteVector($counters,'StarGiftAttributeCounter');
		endif;
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['count'] = $reader->readInt();
		$result['gifts'] = $reader->tgreadVector('StarGift');
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['attributes'] = $reader->tgreadVector('StarGiftAttribute');
		else:
			$result['attributes'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['attributes_hash'] = $reader->readLong();
		else:
			$result['attributes_hash'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		if($flags & (1 << 2)):
			$result['counters'] = $reader->tgreadVector('StarGiftAttributeCounter');
		else:
			$result['counters'] = null;
		endif;
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>