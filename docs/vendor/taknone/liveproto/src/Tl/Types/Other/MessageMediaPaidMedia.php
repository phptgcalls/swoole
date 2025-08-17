<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars_amount Vector<MessageExtendedMedia> extended_media
 * @return MessageMedia
 */

final class MessageMediaPaidMedia extends Instance {
	public function request(int $stars_amount,array $extended_media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa8852491);
		$writer->writeLong($stars_amount);
		$writer->tgwriteVector($extended_media,'MessageExtendedMedia');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stars_amount'] = $reader->readLong();
		$result['extended_media'] = $reader->tgreadVector('MessageExtendedMedia');
		return new self($result);
	}
}

?>