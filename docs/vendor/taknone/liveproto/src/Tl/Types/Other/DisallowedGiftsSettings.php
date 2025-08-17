<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true disallow_unlimited_stargifts true disallow_limited_stargifts true disallow_unique_stargifts true disallow_premium_gifts
 * @return DisallowedGiftsSettings
 */

final class DisallowedGiftsSettings extends Instance {
	public function request(? true $disallow_unlimited_stargifts = null,? true $disallow_limited_stargifts = null,? true $disallow_unique_stargifts = null,? true $disallow_premium_gifts = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x71f276c4);
		$flags = 0;
		$flags |= is_null($disallow_unlimited_stargifts) ? 0 : (1 << 0);
		$flags |= is_null($disallow_limited_stargifts) ? 0 : (1 << 1);
		$flags |= is_null($disallow_unique_stargifts) ? 0 : (1 << 2);
		$flags |= is_null($disallow_premium_gifts) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['disallow_unlimited_stargifts'] = true;
		else:
			$result['disallow_unlimited_stargifts'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['disallow_limited_stargifts'] = true;
		else:
			$result['disallow_limited_stargifts'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['disallow_unique_stargifts'] = true;
		else:
			$result['disallow_unique_stargifts'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['disallow_premium_gifts'] = true;
		else:
			$result['disallow_premium_gifts'] = false;
		endif;
		return new self($result);
	}
}

?>