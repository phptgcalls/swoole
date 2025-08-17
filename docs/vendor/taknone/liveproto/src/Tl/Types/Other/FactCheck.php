<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash true need_check string country textwithentities text
 * @return FactCheck
 */

final class FactCheck extends Instance {
	public function request(int $hash,? true $need_check = null,? string $country = null,? object $text = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb89bfccf);
		$flags = 0;
		$flags |= is_null($need_check) ? 0 : (1 << 0);
		$flags |= is_null($country) ? 0 : (1 << 1);
		$flags |= is_null($text) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($country) === false):
			$writer->tgwriteBytes($country);
		endif;
		if(is_null($text) === false):
			$writer->write($text->read());
		endif;
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['need_check'] = true;
		else:
			$result['need_check'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['country'] = $reader->tgreadBytes();
		else:
			$result['country'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['text'] = $reader->tgreadObject();
		else:
			$result['text'] = null;
		endif;
		$result['hash'] = $reader->readLong();
		return new self($result);
	}
}

?>