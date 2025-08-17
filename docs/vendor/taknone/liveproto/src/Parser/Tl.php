<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Parser;

use function Amp\File\openFile;

use function Amp\File\read;

readonly class Tl {
	static public function parseFile(string $path,? string $json = null) : array {
		$content = read($path);
		$lines = explode(chr(10),$content);
		$type = 'constructors';
		$array = array();
		foreach($lines as $line):
			if(empty($line) === false):
				if(preg_match('~^---(?<type>\w+)---$~',$line,$match)):
					$type = ($match['type'] === 'functions') ? 'methods' : 'constructors';
				elseif(preg_match('~^(?<method>[\w.]+)\#(?<id>[0-9a-f]+)(?<args>.*)?\s=\s(?<response>[\w\d<>#.?]+);$~',$line,$match)):
					$key = ($type === 'methods') ? 'method' : 'predicate';
					$parameters = array();
					if(preg_match_all('~(?<bracketstart>\{)?(?<name>\w+):(?<type>[\w\d<>#.?!]+)(?<bracketend>\})?~',$match['args'],$args,PREG_SET_ORDER)):
						foreach($args as $arg):
							if(isset($arg['bracketstart'],$arg['bracketend']) === false):
								$parameters []= ['name'=>$arg['name'],'type'=>$arg['type']];
							endif;
						endforeach;
					endif;
					$array[$type] []= ['raw'=>$line,'id'=>strval(hexdec($match['id'])),$key=>$match['method'],'params'=>$parameters,'type'=>$match['response']];
				endif;
			endif;
		endforeach;
		if(is_null($json) === false):
			$stream = openFile($json,'w+');
			$json = json_encode($array,JSON_PRETTY_PRINT);
			$withtab = str_replace(str_repeat(chr(32),4),chr(9),$json);
			$stream->write($withtab);
			$stream->close();
		endif;
		return $array;
	}
	static function parseType(string $type) : array {
		$data = array();
		if(preg_match('~(?:flags(?<number>\d+)?\.(?<index>\d+)\?)?(?<type>[\w#]+(?:<(?<vector>.*)>)?)~',$type,$match)):
			$data['is_flag'] = (strlen($match['index']) > 0);
			$data['flag_number'] = intval(strlen($match['number']) > 0 ? $match['number'] : $data['is_flag']);
			$data['flag_index'] = intval(strlen($match['index']) ? $match['index'] : -1);
			$data['flag_indicator'] = ($match['type'] === chr(35));
			$data['is_vector'] = isset($match['vector']);
			$data['type'] = isset($match['vector']) ? $match['vector'] : strtolower($match['type']);
		endif;
		return $data;
	}
	static function parseDocComment(object $class) : array {
		$reflection = new \ReflectionClass($class);
		$docComment = $reflection->getDocComment();
		$array = array();
		if(preg_match('~@return\s(?<return>.+)~',$docComment,$match)):
			$array['return'] = $match['return'];
		endif;
		if(preg_match('~@param\s(?<param>.+)~',$docComment,$match)):
			$split = explode(chr(32),$match['param']);
			for($i = 0;$i < count($split);$i += 2):
				$array['param'][$split[$i + 1]] = $split[$i];
			endfor;
		endif;
		return $array;
	}
}

?>