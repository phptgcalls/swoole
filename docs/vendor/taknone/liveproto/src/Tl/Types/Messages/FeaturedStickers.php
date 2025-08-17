<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash int count Vector<StickerSetCovered> sets Vector<long> unread true premium
 * @return messages.FeaturedStickers
 */

final class FeaturedStickers extends Instance {
	public function request(int $hash,int $count,array $sets,array $unread,? true $premium = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbe382906);
		$flags = 0;
		$flags |= is_null($premium) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($hash);
		$writer->writeInt($count);
		$writer->tgwriteVector($sets,'StickerSetCovered');
		$writer->tgwriteVector($unread,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['premium'] = true;
		else:
			$result['premium'] = false;
		endif;
		$result['hash'] = $reader->readLong();
		$result['count'] = $reader->readInt();
		$result['sets'] = $reader->tgreadVector('StickerSetCovered');
		$result['unread'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>