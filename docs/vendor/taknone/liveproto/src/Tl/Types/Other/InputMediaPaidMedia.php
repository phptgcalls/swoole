<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars_amount Vector<InputMedia> extended_media string payload
 * @return InputMedia
 */

final class InputMediaPaidMedia extends Instance {
	public function request(int $stars_amount,array $extended_media,? string $payload = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc4103386);
		$flags = 0;
		$flags |= is_null($payload) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($stars_amount);
		$writer->tgwriteVector($extended_media,'InputMedia');
		if(is_null($payload) === false):
			$writer->tgwriteBytes($payload);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['stars_amount'] = $reader->readLong();
		$result['extended_media'] = $reader->tgreadVector('InputMedia');
		if($flags & (1 << 0)):
			$result['payload'] = $reader->tgreadBytes();
		else:
			$result['payload'] = null;
		endif;
		return new self($result);
	}
}

?>