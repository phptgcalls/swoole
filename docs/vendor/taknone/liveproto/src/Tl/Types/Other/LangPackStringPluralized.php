<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string key string other_value string zero_value string one_value string two_value string few_value string many_value
 * @return LangPackString
 */

final class LangPackStringPluralized extends Instance {
	public function request(string $key,string $other_value,? string $zero_value = null,? string $one_value = null,? string $two_value = null,? string $few_value = null,? string $many_value = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c47ac9f);
		$flags = 0;
		$flags |= is_null($zero_value) ? 0 : (1 << 0);
		$flags |= is_null($one_value) ? 0 : (1 << 1);
		$flags |= is_null($two_value) ? 0 : (1 << 2);
		$flags |= is_null($few_value) ? 0 : (1 << 3);
		$flags |= is_null($many_value) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($key);
		if(is_null($zero_value) === false):
			$writer->tgwriteBytes($zero_value);
		endif;
		if(is_null($one_value) === false):
			$writer->tgwriteBytes($one_value);
		endif;
		if(is_null($two_value) === false):
			$writer->tgwriteBytes($two_value);
		endif;
		if(is_null($few_value) === false):
			$writer->tgwriteBytes($few_value);
		endif;
		if(is_null($many_value) === false):
			$writer->tgwriteBytes($many_value);
		endif;
		$writer->tgwriteBytes($other_value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['key'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['zero_value'] = $reader->tgreadBytes();
		else:
			$result['zero_value'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['one_value'] = $reader->tgreadBytes();
		else:
			$result['one_value'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['two_value'] = $reader->tgreadBytes();
		else:
			$result['two_value'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['few_value'] = $reader->tgreadBytes();
		else:
			$result['few_value'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['many_value'] = $reader->tgreadBytes();
		else:
			$result['many_value'] = null;
		endif;
		$result['other_value'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>